<?php include '../assets/includes/header.php'; ?>
<?php $sid = $_GET['id']; ?>
<?php $cid = $_GET['cid']; ?>
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
                    <h2>Quiz: <?php $el->getQuizName($sid); ?></h2>
                </div>
                <div class="panel-content-norm">
                    <span class="error" id="error"></span>
                    <form action="quiz_answer.php" class="quiz" method="post" id="ansQuestion">
                        <?php  $el->getStudentQuestions($cid, $sid) ?>
                        <div class="col-btn">
                            <input class="button back-color-red" type="submit" name="submit" value="Finish">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $id = $_POST['zid'];
        $xid = $_POST['xid'];
        $item = $_POST['item'];
        $score = 0;
        for($x=1; $x<=$item; $x++){
            $a[$x] = $_POST['a'.$x];
            $qid[$x] = $_POST['qid'.$x];
            $cans[$x] = $_POST['cans'.$x];
            
            $el->addAnswer($user, $id, $qid[$x], $a[$x], $cans[$x]);

            if($a[$x] == $cans[$x]){
                $score ++;
            }
        }

        $el->addQuizStatus($id, $user, $item, $score);

        header('Location: quiz.php?cid='. $xid);
    }
?>
<!-- END CONTAINER -->
<?php include '../assets/includes/footer.php'; ?>