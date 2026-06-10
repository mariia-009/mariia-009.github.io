<?php 
require_once 'db.php'; 

// --- ОБРОБКА ФОРМИ ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_comment'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['comment']);
    $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;

    if (!empty($name) && !empty($message)) {
        $sql = "INSERT INTO comments (name, email, message, parent_id) VALUES ('$name', '$email', '$message', '$parent_id')";
        if (mysqli_query($conn, $sql)) {
            header("Location: feedback.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Відгуки</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="subpage-body">

    <nav class="subpage-nav">
        <div class="subpage-nav__container">
            <div class="sidebar__logo subpage-logo">
                <a href="index.html">КвітиПеремоги</a>
            </div>
            <ul class="subpage-nav__links">
                <li><a href="#feedback-home">Головна</a></li>
                <li><a href="#stats-box">Залишити відгук</a></li>
                <li><a href="#discuss">Обговорення</a></li>
            </ul>
        </div>
    </nav>

    <header class="subpage-hero" id = "feedback-home" style="
          background-image: linear-gradient(
              rgba(0, 0, 0, 0.6),
              rgba(0, 0, 0, 0.6)
            ),
            url('img/feedback.jpg');
        ">
        <div class="subpage-hero__content">
            <h1>Відгуки та коментарі</h1>
            <p>Ваші ідеї та конструктивна критика допомагають нам ставати кращими</p>
            <a href="#stats-box" class="subpage-home-btn">Залишити відгук</a>
        </div>
    </header>

    <main class="section--subpage">
        <div class="feedback-container">
            
            <div class="stats-box" id = "stats-box">
                <?php 
                $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM comments");
                $data = mysqli_fetch_assoc($res);
                ?>
                <h3>Всього відгуків додано: <span class="count-num"><?php echo $data['total']; ?></span></h3>
            </div>

            
                <form class="comment-form data-card-container" method="POST" action="feedback.php" id="feedbackForm">
                    <h2 class="form-title">Залиште свій відгук</h2>
                    <input type="hidden" name="parent_id" id="parent_id" value="0">
                    
                    <div class="form-row">
                        <input type="text" name="username" placeholder="Ваше ім'я" required>
                        <input type="email" name="email" placeholder="Ваш Email" required>
                    </div>
                    
                    <textarea name="comment" rows="5" placeholder="Ваша ідея чи відгук..." required></textarea>
                    
                    <div class="form-actions">
                        <button type="submit" name="send_comment" class="nav-btn">Опублікувати</button>
                        <button type="button" onclick="resetForm()" id="cancel-reply" class="nav-btn btn--cancel" style="display:none;">Скасувати відповідь</button>
                    </div>
                </form>


            <section class="comments-display">
                <h3 class="discussion-header" id='discuss'>Обговорення:</h3>
                
                <div class="comments-list">
                    <?php 
                    // Отримуємо головні коментарі
                    $main_result = mysqli_query($conn, "SELECT * FROM comments WHERE parent_id = 0 ORDER BY created_at DESC");

                    if (mysqli_num_rows($main_result) > 0):
                        while($comment = mysqli_fetch_assoc($main_result)): ?>
                            
                            <div class="comment-card" id="comment-<?php echo $comment['id']; ?>">
                                <div class="comment-header">
                                    <h4><?php echo htmlspecialchars($comment['name']); ?></h4>
                                    <span class="comment-date"><?php echo date('d.m.Y H:i', strtotime($comment['created_at'])); ?></span>
                                </div>
                                <div class="comment-body">
                                    <p><?php echo nl2br(htmlspecialchars($comment['message'])); ?></p>
                                </div>
                                <button class="btn-reply" onclick="replyTo(<?php echo $comment['id']; ?>, '<?php echo htmlspecialchars($comment['name']); ?>')">Відповісти</button>

                                <?php 
                                $c_id = $comment['id'];
                                $replies_res = mysqli_query($conn, "SELECT * FROM comments WHERE parent_id = $c_id ORDER BY created_at ASC");
                                while($reply = mysqli_fetch_assoc($replies_res)): ?>
                                    <div class="comment-card reply-card">
                                        <div class="comment-header">
                                            <h5>Відповідь від <?php echo htmlspecialchars($reply['name']); ?>:</h5>
                                            <span class="comment-date"><?php echo date('d.m.Y H:i', strtotime($reply['created_at'])); ?></span>
                                        </div>
                                        <p><?php echo nl2br(htmlspecialchars($reply['message'])); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            </div>

                        <?php endwhile;
                    else: ?>
                        <div class="data-card-container no-comments">
                            <p>Коментарів поки немає. Будьте першими!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

    <script>
    function replyTo(id, name) {
        document.getElementById('parent_id').value = id;
        document.querySelector('.form-title').innerText = "Відповідь для " + name;
        document.getElementById('cancel-reply').style.display = "inline-block";
        document.getElementById('feedbackForm').scrollIntoView({behavior: 'smooth'});
    }

    function resetForm() {
        document.getElementById('parent_id').value = "0";
        document.querySelector('.form-title').innerText = "Залиште свій відгук";
        document.getElementById('cancel-reply').style.display = "none";
    }
    </script>
</body>
</html>