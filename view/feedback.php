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
</div>
<?php if (isset($_SESSION['userId'])) : ?>

    <div class="container">
        <div class="row my-3">
            <div class="col-md-6 mx-auto">
                <h2>Add feedback</h2>
                <form id="add-comment-form" action="" method="post">
                    <div class="form-group my-1">
                    <textarea id="comment-body" name="commentBody" class="form-control "
                              placeholder="Add comment"></textarea>
                        <span class='invalid-feedback'></span>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto submitBtn">
                        <button id='submit-btn' type="submit" class='btn btn-custom'>Add comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--pagal mariu end-->

<?php else: ?>

    <div class="m-5 text-center submitBtn">
        <a href="/register" class="btn btn-custom px-5 py-2">Want to write a feedback?
            Register</a>
    </div>


<?php endif; ?>
<?php
//if (isset($currentPage) && $currentPage === 'feedback') {
//    var_dump($currentPage);
//}
//?>

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
                console.log(data.comments);
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
    }


    function addCommentAsync(event) {
        event.preventDefault();
        resetErrors();

        // add data and post it to api
        const addCommentFormData = new FormData(addCommentFormEl);

        // send data to api
        fetch('http://localhost/addComment', {
            method: 'post',
            body: addCommentFormData
        })
            .then(resp => resp.json())
            .then(data => {
                console.log(data);
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
