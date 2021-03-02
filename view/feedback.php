<?php var_dump($allFeedback); ?>
<!--<div class="row row-cols-1 row-cols-md-3 g-4">-->
<!--        --><?php //foreach ($allFeedback as $feedback) : ?>
<!--        <div class="col">-->
<!--            <div class="card m-2">-->
<!--                <div class="card-header">-->
<!--                    --><?php //echo $feedback->feedbackCreated; ?>
<!--                </div>-->
<!--                <div class="card-body">-->
<!--                    <blockquote class="blockquote mb-0">-->
<!--                        <p>--><?php //echo $feedback->feedbackText; ?><!--</p>-->
<!--                        <footer class="blockquote-footer">The review was written by <cite-->
<!--                                    title="Source Title">--><?php //echo $feedback->userName; ?><!--</cite>-->
<!--                        </footer>-->
<!--                    </blockquote>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //endforeach; ?>
<!--</div>-->
<div class="card">
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Review</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allFeedback as $feedback) : ?>
            <tr>
                <td><?php echo $feedback->userName; ?></td>
                <td><?php echo $feedback->feedbackText; ?></td>
                <td><?php echo $feedback->feedbackCreated; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="row m-3">
    <div class="col-lg-8 mx-auto">
        <div class="card card-body bg-light ">
            <!--            --><?php //flash('registerSuccess'); ?>
            <!--            <h4>Please write feedback</h4>-->
            <form action="" method="post">
                <div class="form-group">
                    <label for="body">Please write Your feedback: <sup>*</sup></label>
                    <textarea name="body" id="body"
                              class="<?php echo (!empty($errors['textErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg">
                        <?php echo $feedbackText ?></textarea>
                    <span class="invalid-feedback"><?php echo $errors['textErr']; ?></span>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mx-auto">
                        <input type="submit" class="btn btn-secondary w-100" value="Send feedback">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



