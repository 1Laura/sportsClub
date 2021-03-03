<?php //use app\core\FormFieldHtml; ?>
<?php //var_dump($currentPage); ?>

<div class="row m-5">
    <div class="col-lg-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php //flash('registerFail'); ?>
            <h2>Create an account</h2>
            <!--            --><?php //var_dump($params); ?>
            <!--            --><?php //var_dump($_POST); ?>
            <p>Please fill in the form to register with us</p>
            <form action="" method="post" id="registration-form">
                <!--                --><?php //echo new FormFieldHtml('name', 'name', '', 'Name', 'text', 'required', $params); ?>
                <!--                --><?php //echo new FormFieldHtml('surname', 'surname', '', 'Surname', 'text', 'required', $params); ?>
                <!--                --><?php //echo new FormFieldHtml('email', 'email', '', 'Email', 'text', 'required', $params); ?>
                <!--                --><?php //echo new FormFieldHtml('phoneNumber', 'phoneNumber', '', 'Phone Number', 'text', '', $params); ?>
                <!--                --><?php //echo new FormFieldHtml('address', 'address', '', 'Address', 'text', '', $params); ?>
                <!--                --><?php //echo new FormFieldHtml('password', 'password', '', 'Password', 'password', 'required', $params); ?>
                <!--                --><?php //echo new FormFieldHtml('confirmPassword', 'confirmPassword', '', 'Confirm password', 'password', 'required', $params); ?>

                <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" id="name"
                           class="<?php echo !empty($errors['nameErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $name; ?>">
                    <span class="invalid-feedback"><?php echo $errors['nameErr']; ?></span>
                </div>
                <div class="form-group">
                    <label for="name">Surname: <sup>*</sup></label>
                    <input type="text" name="surname" id="surname"
                           class="<?php echo !empty($errors['surnameErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $surname; ?>">
                    <span class="invalid-feedback"><?php echo $errors['surnameErr']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="text" name="email" id="email"
                           class="<?php echo !empty($errors['emailErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $errors['emailErr']; ?></span>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone number: </label>
                    <input type="text" name="phoneNumber" id="phoneNumber"
                           class="<?php echo !empty($errors['phoneNumberErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $phoneNumber ?? ''; ?>">
                    <span class="invalid-feedback"><?php echo $errors['phoneNumberErr']; ?></span>
                </div>
                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="address" id="address"
                           class="<?php echo !empty($errors['addressErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $address ?? ''; ?>">
                    <span class="invalid-feedback"><?php echo $errors['addressErr']; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" id="password"
                           class="<?php echo !empty($errors['passwordErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $errors['passwordErr']; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm password: <sup>*</sup></label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                           class="<?php echo !empty($errors['confirmPasswordErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $confirmPassword; ?>">
                    <span class="invalid-feedback"><?php echo $errors['confirmPasswordErr']; ?></span>
                </div>


                <div class="row mt-3">
                    <div class="col submitBtn">
                        <input type="submit" class="btn btn-custom w-100" value="Register">
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