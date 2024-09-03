<?php
    phpinfo();
    die();
    require 'class/Message.php';
    require 'class/GuestBook.php';
    $success = false;
    $errors = null;
    $guestbook = new GuestBook(__DIR__. DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
    if(isset($_POST['username'], $_POST['message']))
    {
        $message = new Message($_POST['username'], $_POST['message']);
        if($message->isValid()){
            $guestbook = new GuestBook(__DIR__. DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
            $guestbook->addMessage($message);
            $success = true;
            $_POST[] = [];
        }else{
            $errors = $message->getErrors();
        }
    }
    $messages = $guestbook->getMessages();
    $title = "Livre d'or ";
    require 'elements/header.php';
?>
    <div class="container">
        <h1>Livre d'or</h1>
        <?php if($errors): ?>
            <div class="alert alert-danger">Formulaire invalide</div>
        <?php endif ?>

        <?php if($success): ?>
            <div class="alert alert-success">Merci pour votre message</div>
        <?php endif ?>
        <form action="" method="post">
            <div class="form-group">
                <input value="<?= $_POST['username'] ?? '' ?>" type="text" name="username" id="" placeholder="Entrer votre pseudo" class="form-control <?= isset($errors['username']) ? 'is-invalid' : "" ?>" >
                <?php if(isset($errors['username'])): ?>
                     <div class="invalid-feedback"><?= $errors['username'] ?></div>
                <?php endif ?>
            </div><br>
            <div class="form-group">
                <textarea  name="message" id="" placeholder="Entrer votre message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : "" ?> "> <?= $_POST['message'] ?? '' ?></textarea>
                <?php if(isset($errors['message'])): ?>
                     <div class="invalid-feedback"><?= $errors['message'] ?></div>
                <?php endif ?>
            </div><br>
            <button class="btn btn-primary">Envoyer</button>
        </form>
        <?php if(!empty($messages)):  ?>
        <h1 class="mt-4">Vos messages</h1>
        <?php foreach($messages as $message): ?>
            <?= $message->toHTML() ?>
        <?php endforeach ?>
        <?php endif ?>SSSSSSSSSSSSSSSSSSSSSSSSSSSS
    </div>

<?php require 'elements/footer.php'?>