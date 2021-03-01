<?php use app\core\FormFieldHtml; ?>
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php //flash('registerFail'); ?>
            <h2>Create an account</h2>
            <?php var_dump($params); ?>
            <p>Please fill in the form to register with us</p>
            <form action="" method="post" id="registration-form">
                <?php echo new FormFieldHtml('name', 'name', '', 'Name', 'text', 'required', $params); ?>
                <?php echo new FormFieldHtml('surname', 'surname', '', 'Surname', 'text', 'required', $params); ?>
                <?php echo new FormFieldHtml('email', 'email', '', 'Email', 'text', 'required', $params); ?>
                <?php echo new FormFieldHtml('phoneNumber', 'phoneNumber', '', 'Phone Number', 'text', '', $params); ?>
                <?php echo new FormFieldHtml('address', 'address', '', 'Address', 'text', '', $params); ?>
                <?php echo new FormFieldHtml('password', 'password', '', 'Password', 'password', 'required', $params); ?>
                <?php echo new FormFieldHtml('confirmPassword', 'confirmPassword', '', 'Confirm password', 'password', 'required', $params); ?>
                <div class="row mt-3">
                    <div class="col">
                        <input type="submit" class="btn btn-secondary w-100" value="Register">
                    </div>
                    <div class="col">
                        <a href="/login" class="btn btn-light w-100">Have an
                            account? Login</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>