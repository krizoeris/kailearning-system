<?php include '../assets/includes/header.php'; ?>
<?php $id = $_GET['id']; ?>
<!-- DIRECTORY -->
<div class="main-dir">
    <h1>Quiz</h1>
</div>
<!-- END DIRECTORY -->

<!-- CONTAINER -->
<div class="main-container">
    <div class="inner-container">
        <div class="content-row">
            <div class="panel back-color-white">
                <div class="panel-header-norm">
                    <h2>Create Quiz</h2>
                </div>
                <div class="panel-content-norm">
                    <span class="error" id="error"></span>
                    <form class="enter-announce" method="post" id="setQuiz">
                        <div>
                            <label class="data-name">Quiz Title:</label>
                            <input type="text" id="title" required>
                        </div>
                        <input type="text" value="<?php echo $id; ?>" id="classes" hidden required>
                        <div class="col-btn">
                            <button class="button back-color-green">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER -->
<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
<script type="text/javascript">document.getElementById('setQuiz').addEventListener('submit', setQuiz);</script>
<?php include '../assets/includes/footer.php'; ?>