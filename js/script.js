"use strict"

document.addEventListener('DOMContentLoaded', ()=>{
    
    const mainBtn = document.querySelector('.main-btn'),
        cardBtnList = document.querySelectorAll('.card__btn'),
        orderForm = document.querySelector('.order'),
        form = document.querySelector('.order__form'),
        checkboxList = document.querySelectorAll('.order__checkbox-item');
    //Modal

    mainBtn.addEventListener('click', ()=>{
        orderForm.classList.add('active');
    });
    orderForm.addEventListener('click', (e) => {
        if (e.target.hasAttribute('data-close')) {
            orderForm.classList.remove('active');
        }
    })

    function showSuccessMessage(parent) {
        parent.innerHTML = 
        `<div class="order_success">
            <div class="order__close" data-close>&times;</div>
            <h2 class="order__title_success">success</h2>
            <p class="order__content_success">we'll contact you soon</p>
        </div>`
    }

    function showFailureMessage(parent, error) {
        parent.innerHTML = 
        `<div class="order_success">
            <div class="order__close" data-close>&times;</div>
            <h2 class="order__title_success">something went wrong, please try again later</h2>
            <p class="order__content_success">error #${error}</p>
        </div>`
    }

    //Cards buttons

    cardBtnList.forEach((el,index) => {
        el.addEventListener('click', ()=>{
            if (checkboxList[index].checked === false){
                checkboxList[index].checked = true;
                el.textContent = 'remove from order';
            } else if (checkboxList[index].checked === true){
                checkboxList[index].checked = false;
                el.textContent = 'add from order';
            }
        })
    });

    //Form

    async function getAndPostData() {

        form.style.opacity = '0.33';

        const formData = new FormData(form),
            response = await fetch('mail.php', {
            method: 'POST',
            body: formData
        })
        .then(() => {showSuccessMessage(orderForm)})
        .catch(() => {showFailureMessage(orderForm, response.status)})
        .finally()
    }

    //Validation

    function validation(event) {

        event.preventDefault();

        let valid = false;
        checkboxList.forEach(el => {
            if (el.checked == true) {
                valid = true;
            }
        });
        if (valid == true) {
            orderForm.style.border = '0px'
            getAndPostData()
        } else {
            orderForm.style.border = '3px solid red'
        }
    }
    
    form.addEventListener('submit', validation);
}); 