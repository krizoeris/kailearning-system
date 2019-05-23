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
                    <h2>Edit Quiz</h2>
                </div>
                <div class="panel-content-norm">
                    <span class="error" id="error"></span>
                    <form class="enter-announce" method="post" id="editQuiz">
                        <div>
                            <label class="data-name">Quiz Title:</label>
                            <input type="text" value="<?php echo $title; ?>" id="title" required>
                            <input type="hidden" value="<?php echo $id; ?>" id="jid">
                        </div>
                        <div class="col-btn">
                            <button class="button back-color-green">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER -->
<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
<script type="text/javascript">document.getElementById('editQuiz').addEventListener('submit', editQuiz);</script>
<?php include '../assets/includes/footer.php'; ?>