<div id="content">
      <h3>Заполните формы</h3>
      <form  action="insertDb" method="post" enctype="multipart/form-data">
        <input type="text" name="name" max="100" placeholder="Ваше имя" required>
        <input type="number" name="phone" max="15" placeholder="Номер телефона" required>
        <input type="text" name="caption" max="1000" placeholder="Заголовок вопроса" required>
        <textarea type="text" name="description" placeholder="Вопрос" min="10" required></textarea>
        <input type="file" name="image">
        <input type="submit">
      </form>
  </div>