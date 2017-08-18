<div id="content">
      <h3>Заполните формы</h3>
      <form  action="insertDb" method="post" enctype="multipart/form-data">
        <input type="text" name="name" maxlength="100" placeholder="Ваше имя" required>
        <input type="number" name="phone" maxlength="15" placeholder="Номер телефона" required>
        <input type="text" name="caption" mixlength="10" placeholder="Заголовок вопроса" required>
        <textarea type="text" name="description" placeholder="Вопрос" required></textarea>
        <input type="file" name="image">
        <input type="submit">
      </form>
  </div>