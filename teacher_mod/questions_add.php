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
                    <h2>Add Question</h2>
                </div>
                <div class="panel-content-norm">
                    <span class="error" id="error"></span>
                    <form class="enter-announce" method="post" id="setQuestion">
                        <div>
                            <label class="data-name">Question:</label>
                            <input type="text" id="question" required>
                        </div>
                        <div>
                            <label class="data-name">Choice A:</label>
                            <input type="text" id="ca" required>
                        </div>
                        <div>
                            <label class="data-name">Choice B:</label>
                            <input type="text" id="cb" required>
                        </div>
                        <div>
                            <label class="data-name">Choice C:</label>
                            <input type="text" id="cc" required>
                        </div>
                        <div>
                            <label class="data-name">Choice D:</label>
                            <input type="text" id="cd" required>
                        </div>
                        <div>
                            <label class="data-name">Answer:</label>
                            <select id="answer" required>
                                <option>Select Answer</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <input type="text" value="<?php echo $id; ?>" id="quizid" hidden required>
                        <div class="col-btn">
                            <button class="button back-color-green">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER -->
<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
<script type="text/javascript">document.getElementById('setQuestion').addEventListener('submit', setQuestion);</script>
<?php include '../assets/includes/footer.php'; ?>