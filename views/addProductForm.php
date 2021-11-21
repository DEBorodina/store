<form action="/save_product" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; width:30%">
    <input type="text" name="name">
    <textarea name="description"></textarea>
    <input type="file" name="img[]" multiple>
    <button type="submit">Send</button>
</form>