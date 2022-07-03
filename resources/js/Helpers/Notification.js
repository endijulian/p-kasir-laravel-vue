class Notification{

    success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Succesfully Done!',
            timeout: 1000,
        }).show();
    }

    alert(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure ?',
            timeout: 1000,
        }).show();
    }

    error(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Something Went Wrong',
            timeout: 1000,
        }).show();
    }

    warning(){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Oppss Wrong!',
            timeout: 1000,
        }).show();
    }

    image_validation(){
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Upload Image less then 1MB!',
            timeout: 1000,
        }).show();
    }

    cart_success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Succesfully Add to cart!',
            timeout: 1000,
        }).show();
    }

    cart_delete(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Succesfully delete cart!',
            timeout: 1000,
        }).show();
    }

}

export default Notification = new Notification()
