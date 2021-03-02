<?php //var_dump($allFeedback); ?>
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
<div class="container">
    <h2 class='my-3'>Comments</h2>
    <div class="card">
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Review</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody id="comments">
            <!--            --><?php //foreach ($allFeedback as $feedback) : ?>
            <!--                <tr>-->
            <!--                    <td>--><?php //echo $feedback->userName; ?><!--</td>-->
            <!--                    <td>--><?php //echo $feedback->feedbackText; ?><!--</td>-->
            <!--                    <td>--><?php //echo $feedback->feedbackCreated; ?><!--</td>-->
            <!--                </tr>-->
            <!--            --><?php //endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php if (isset($_SESSION['userId'])) : ?>

    <!--    <div class="row m-3">-->
    <!--        <div class="col-lg-8 mx-auto">-->
    <!--            <div class="card card-body bg-light ">-->
    <!--                            --><?php ////flash('registerSuccess'); ?>
    <!--                          <h4>Please write feedback</h4>-->
    <!--                <form action="" method="post">-->
    <!--                    <div class="form-group">-->
    <!--                        <label for="body">Please write Your feedback: <sup>*</sup></label>-->
    <!--                        <textarea name="text" id="text"-->
    <!--                                  class="--><?php //echo (!empty($errors['textErr'])) ? 'is-invalid' : ''; ?><!-- form-control form-control-lg">-->
    <!--                        --><?php //echo trim($text ?? ''); ?><!--</textarea>-->
    <!--                        <span class="invalid-feedback">--><?php //echo $errors['textErr']; ?><!--</span>-->
    <!--                    </div>-->
    <!--                    <div class="row mt-3">-->
    <!--                        <div class="col-md-6 mx-auto">-->
    <!--                            <input type="submit" class="btn btn-secondary w-100" value="Send feedback">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </form>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--pagal Mariu-->
    <div class="container">
        <div class="row mb-5">
            <!--            <div class="col-12">-->
            <!--                <h2 class='my-3'>Comments</h2>-->
            <!--                <div id="comments" class="comment-container">-->
            <!--                    <h2 class="display-3">Loading</h2>-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="col-12">
                <h2>Add feedback</h2>
                <form id="add-comment-form" action="" method="post">
                    <!--                <div class="form-group">-->
                    <!--                    <input id="username"  type="text" name="username" class="form-control" value="-->
                    <?php //echo $_SESSION['user_name'] ?><!--" placeholder="Your Name">-->
                    <!--                    <span class='invalid-feedback'></span>-->
                    <!--                </div>-->
                    <div class="form-group">
                    <textarea id="comment-body" name="commentBody" class="form-control "
                              placeholder="Add comment"></textarea>
                        <span class='invalid-feedback'></span>
                    </div>
                    <button id='submit-btn' type="submit" class='btn btn-success'>Comment</button>
                </form>
            </div>
        </div>
    </div>
    <!--pagal mariu end-->

<?php else: ?>
    <div class="m-5 text-center">
        <a href="/register" class="btn btn-secondary">Want to write a feedback?
            Register</a>
    </div>


<?php endif; ?>
<?php var_dump($_SESSION); ?>

<script>
    const commentsOutputEl = document.getElementById('comments');
    const addCommentFormEl = document.getElementById('add-comment-form');
    const commentBodyEl = document.getElementById('comment-body');
    // const usernameInputEl = document.getElementById('username');
    const submitBtnEl = document.getElementById('submit-btn');

    addCommentFormEl.addEventListener('submit', addCommentAsync);
    commentBodyEl.addEventListener('input', clearErrorsOnInput);

    fetchComments();

    function clearErrorsOnInput(event) {
        // console.log('clearErrorsOnInput');
        // if input length is  2 and more characters we remove error class
        const stringLength = event.target.value.length;
        // console.log(stringLength)
        if (stringLength > 1) {
            event.target.classList.remove('is-invalid');
            submitBtnEl.removeAttribute('disabled');
        }
    }

    function fetchComments() {
        fetch('http://localhost/comments')
            .then(resp => resp.json())
            .then(data => {
                console.log(data);
                generateHTMLComments(data.comments);
            });
    }

    function generateHTMLComments(commentArr) {
        console.log(commentArr)
        commentsOutputEl.innerHTML = '';
        commentArr.forEach(function (commentObj) {
            commentsOutputEl.innerHTML += generateComment(commentObj);
        });
    }

    function generateComment(oneComment) {
        // console.log(oneComment)
        return `<tr>
                    <td>${oneComment.userName}</td>
                    <td>${oneComment.feedbackText}</td>
                    <td>${oneComment.feedbackCreated}</td>
                </tr>`;

        // return `
        //         <div class="card" id='${oneComment.userId}' >
        //             <div class="card-header">
        //             ${oneComment.userName}
        //             <span>${oneComment.feedbackCreated}</span></div>
        //             <div class="card-body">
        //                 ${oneComment.feedbackText}
        //             </div>
        //         </div>
        //     `;
    }


    function addCommentAsync(event) {
        event.preventDefault();
        resetErrors();

        // add data and post it to api
        const addCommentFormData = new FormData(addCommentFormEl);

        // send data to api
        fetch('<?php echo '/addComment' ?>', {
            method: 'post',
            body: addCommentFormData
        })
            .then(resp => resp.json())
            .then(data => {
                // console.log(data);
                if (data.success) {
                    handleSuccessComment();
                } else {
                    handleCommentError(data.errors)
                }
            })
            .catch(error => console.error(error));
    }

    function handleSuccessComment() {
        // clear comment fields
        commentBodyEl.value = '';

        // add new comment
        fetchComments();
    }

    function handleCommentError(errorObj) {
        console.log('handleCommentError');
        console.log(errorObj);

        submitBtnEl.setAttribute('disabled', '');

        if (errorObj.commentBodyErr) {
            // add error class
            commentBodyEl.classList.add('is-invalid');
            //add error text
            commentBodyEl.nextElementSibling.innerHTML = errorObj.commentBodyErr;
        }
    }

    function resetErrors() {
        // search form for al is-inavlid clases and remove them
        const errorEl = addCommentFormEl.querySelectorAll('.is-invalid');
        // console.log("errorEl")
        // console.log(errorEl)
        errorEl.forEach((errorInputEl) => errorInputEl.classList.remove('is-invalid'));
    }


</script>
