!(function(){
    var showTypes=[];
    if(document.querySelector('.product-panel table')){
        var lastId=document.querySelector('.product-panel table').dataset.lastid;
    }
    function hideOrShow(category,element){
        var hide=true;
        showTypes.forEach(function(item){
            if(category==item){
                hide=false;
            }
        });
        if(hide&&showTypes.length!=0){
            $(element).hide();
        }
        else{
            $(element).show();
        }
    }

    function lodaNextElements(){
        $.getJSON('/product-list',{lastId: lastId},function(data){
            var tbody=$('.product-panel tbody')[0];
            var newElements=data.forEach(function(item){
                var tr=document.createElement('tr');
                tr.setAttribute('data-id',item.id); //.data('id',item.id);
                $(tr).append('<td>'+item.name+'</td>');
                $(tr).append('<td>'+item.category+'</td>');
                $(tr).append('<td>'+item.price+'</td>');

                hideOrShow(item.category,tr);

                tbody.append(tr);
                if(lastId<item.id){
                    lastId=item.id;
                }
            });
            console.log(lastId);
        });

    }

    $('.filter-panel input[type=checkbox]').change(function(event){
        if($(event.target).is (':checked')){
            //showTypes.push($(event.target).parent()[0].firstChild.innerHTML);
            showTypes.push($(event.target).parent()[0].firstChild.innerHTML);
            //console.log(event.target.dataset);
        }
        else{
            showTypes=showTypes.filter(function(item){
                if(item == $(event.target).parent()[0].firstChild.innerHTML){
                    return false
                }
                else{
                    return true;
                }
            });
        }
        if(showTypes.length!=0){
            var elements=document.querySelectorAll('.product-panel tr');
            elements.forEach(function(item,i){
                if(i!=0){
                    var product=item;
                    var productCategory=item.children[1].innerHTML;
                    hideOrShow(productCategory,product);
                    if(lastId<item.dataset.id){
                        lastId=item.dataset.id;
                    }
                }
            });

            lodaNextElements();
        }
        else{
            document.querySelectorAll('.product-panel tr').forEach(function(item){
                $(item).show();
            });
        }
    });

    $('#next').click(function(){
       lodaNextElements();
    });

    $('#addProductSubmit').submit(function(event){
        event.preventDefault();
        alert('s');
        console.dir(event)
    });
})()