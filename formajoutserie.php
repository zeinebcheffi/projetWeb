<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #560f0f;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        overflow: hidden;
    }

    form {
        width: 380px;
        padding: 40px;
        background-color: rgba(63, 70, 87, 0.9); /* Fond sombre transparent */
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7); /* Ombre plus profonde */
        backdrop-filter: blur(20px);
        animation: formAppear 0.8s ease-out; /* Animation d'apparition */
    }

    @keyframes formAppear {
        0% {
            transform: translateY(-50px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    h2 {
        text-align: center;
        color: #ff0099; /* Rose fluo dynamique */
        margin-bottom: 30px;
        font-size: 2.5em;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    label {
        display: block;
        margin-bottom: 12px;
        font-size: 16px;
        color: #ddd;
        font-weight: 600;
    }

    input {
        width: 100%;
        padding: 16px;
        margin-bottom: 20px;
        border: 2px solid #444;
        border-radius: 10px;
        background-color: #333;
        color: white;
        font-size: 18px;
        transition: all 0.4s ease-in-out;
        box-sizing: border-box;
    }

    input:focus {
        border-color: #560f0f; /* Bordure rose fluo sur focus */
        background-color: #444;
        outline: none;
    }

    button {
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #560f0f); /* Dégradé vibrant */
        color: white;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        background-color: #560f0f; /* Couleur solide sans animation */
    }

    
</style>

<body>
    <!-- Formulaire pour ajouter une série avec l'action vers "ajoutserie.php" -->
    <form method="post" action="ajoutserie.php">
        <label for="tit">Titre:</label>
        <input type="text" name="tit" required>

        <label for="url">URL:</label>
        <input type="text" name="url" required>

        <label for="nbs">nombre de saison:</label>
        <input type="number" name="nbs" required>

        <label for="imgs">Image:</label>
        <input type="text" name="imgs" required>

        <label for="categorieS">Catégorie:</label>
        <input type="text" name="categorieS" required>

        <button type="submit" name="ajoutserie">Ajouter serie</button>
    </form>
</body>
</html>
