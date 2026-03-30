<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('professionnel.store')}}" method="POST">
        @csrf
        <!-- Form fields for creating a professional account -->
         <input type="text" name="category" placeholder="Category">
            <input type="number" name="spesialitie_id" placeholder="Speciality ID">
            <input type="text" name="bio" placeholder="Bio">

        <button type="submit">Create Professional Account</button>
    </form>
</body>
</html>