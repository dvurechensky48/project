<div id="content">
      

      <div class = "application">
        <div class="application_left"><img src = "img/<?php echo($id_photo) ?>.png" alt = "Заявка"></div>
        <div class ="application_right">
          <form method="post" action="/editDb">
          <input type="hidden" name="id_request" value="<?php echo($id_request); ?>">
          <input type="text" name = "application_name" value="<?php echo($application_name) ?>">
          <div class="phone"><b><?php echo($client_name); ?></b> - <?php echo($client_phone) ?></div>
          <textarea width="100%" type ="text" name = "application_text" class="application_text"><?php echo($application_text) ?></textarea><br>
          <button name="but" value = "edit">Редактировать</button><button name="but" value = "delete">Удалить</button>
          </form>
        </div>


  </div>
</div>