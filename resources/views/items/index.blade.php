<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center; 
        }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #333;
            font-family: monospace;
        }
        
        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        input[type="text"] {
            width: calc(100% - 120px); 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            text-align: left; 
        }
        
        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        input[type="checkbox"] {
            transform: scale(1.5); 
            margin-right: 10px;
        }
        
        .buttons {
            display: flex;
            align-items: center;
        }
        
        .buttons button {
            margin-left: 5px;
        }
        
        .checked-text {
            text-decoration: line-through;
            color: #888; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des courses</h1>
        
        <form action="{{ route('items.store') }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Ajouter un article">
            <button type="submit">Ajouter</button>
        </form>
        
        <ul>
            @foreach ($items as $item)
            <li>
                <form action="{{ route('items.update', $item) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="checked" {{ $item->checked ? 'checked' : '' }}>
                    <input type="text" name="name" value="{{ $item->name }}" class="{{ $item->checked ? 'checked-text' : '' }}">
                    <div class="buttons">
                        <button type="submit">Modifier</button>
                    </div>
                </form>
                <form action="{{ route('items.destroy', $item) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
    <script>
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var form = this.closest('form');
                form.submit();
            });
        });
    </script>
</body>
</html>