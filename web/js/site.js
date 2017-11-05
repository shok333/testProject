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

    function loadNextElements(){
        $.getJSON('/product-list',{lastId: lastId},function(data){
            var tbody=$('.product-panel tbody')[0];
            var newElements=data.forEach(function(item){
                var tr=document.createElement('tr');
                tr.setAttribute('data-id',item.id); //.data('id',item.id);
                $(tr).append('<td>'+item.name+'</td>');
                $(tr).append('<td>'+item.category+'</td>');
                $(tr).append('<td>'+item.price+'</td>');

                var show=hideOrShow(item.category,tr);

                tbody.append(tr);
                if(lastId<item.id){
                    lastId=item.id;
                }
            });
        });

    }

    $('.filter-panel input[type=checkbox]').change(function(event){
        if($(event.target).is (':checked')){
            //showTypes.push($(event.target).parent()[0].firstChild.innerHTML);
            showTypes.push($(event.target).parent()[0].firstChild.innerHTML);

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
            loadNextElements();
        }
        else{
            document.querySelectorAll('.product-panel tr').forEach(function(item){
                $(item).show();
            });
        }
    });

    $('#next').click(function(){
       loadNextElements();
    });

    function formSubmitHandler(event){
        event.preventDefault();
        var ajaxStatus=document.querySelector('#ajax-status');
        ajaxStatus.classList.remove('alert-danger-animation','alert-danger','alert-success-animation','alert-success');
        ajaxStatus=$(ajaxStatus);

        function reset(event){
            event.preventDefault();
        }
        form.bind('submit',reset);
        form.unbind('submit',formSubmitHandler);


        var empty=false;
        var emptyInputs=[];
        if(this.name.value==''){
            empty=true;
            emptyInputs.push(' "Название товара" ');
        }
        if(this.category.value==''){
            empty=true;
            emptyInputs.push(' "Категория товара" ');
        }
        if(this.price.value==''){
            empty=true;

            emptyInputs.push(' "Цена" ');
        }
        if(this.price.value!=''){
            if(!(+this.price.value)){
                empty=true;
                emptyInputs.push('. <strong>Введено недопустимое значение цены</strong>');
            }
        }
        if(empty){
            var emptyMessage='<strong>Заполните поля:</strong> '
            emptyInputs.forEach(function(item){
                emptyMessage+=item;
            });
            ajaxStatus.html(emptyMessage);
            ajaxStatus.removeClass('alert-success');
            ajaxStatus.addClass('alert-danger alert-danger-animation')
            form.bind('submit',formSubmitHandler);
            return;
        }
        $.post('/add-product',$(this).serialize(),function(data){
            if(data){
                ajaxStatus.removeClass('alert-danger');
                ajaxStatus.addClass('alert-success alert-success-animation');
                ajaxStatus.html('Товар добавлен');
                form.bind('submit',formSubmitHandler);
            }
            else{
                ajaxStatus.addClass('alert-danger-animation');
                ajaxStatus.html('К сожалению, не удалось добавить товар');
                form.bind('submit',formSubmitHandler);
            }

        }).fail(function(){
            ajaxStatus.addClass('alert-danger-animation');
            ajaxStatus.html('К сожалению, не удалось добавить товар');
            form.bind('submit',formSubmitHandler);
        });
    }
    var form=$('#addProductSubmit');
    form.bind('submit',formSubmitHandler);

})()