<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>articles</title>
</head>
<body>
    <form action="/api/articles">
        @csrf
        @method('GET')
        <div class="form-control">
            <input type="text" name="" id="" placeholder="Title">
        </div>
        <div class="form-control">
            <input type="text" name="" id="" placeholder="Slug">
        </div>
        <div class="form-control">
            <textarea name="" id="" placeholder="Description"></textarea>
        </div>
        <div class="form-control">
            <textarea name="" id="" placeholder="Content"></textarea>
        </div>
        <button>Submit</button>
    </form>
</body>
</html>