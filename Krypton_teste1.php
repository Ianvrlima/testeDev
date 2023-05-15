<!DOCTYPE html>
<html>
<head>
    <title>Tabela Crypton</title>
</head>
<body>
    <h2>Listagem de Carros</h2>

    <ul id="ListaCarro"></ul>

    <h3>Inserir Carro</h3>
    <form id="FormCarro">
        <label for="IdCarro">ID do Carro:</label>
        <input type="number" id="idCarro" required>
        <br><br>
        <label for="marca">Marca:</label>
        <input type="text" marca="marca" required>
        <br><br>
        <label for="modelo">Modelo:</label>
        <input type="text" id="idCarro" required>
        <br><br>
        <label for="cor">Cor do Carro:</label>
        <input type="text" cor="cor" required>
        <br><br>
        <h3>Inserir Motor do Carro</h3>
        <label for="IdMotor">Id do Motor:</label>
        <input type="number" IdMotor="IdMotor" required>
        <br><br>
        <label for="posicionamento_cilindros">Posicionamento de cilindros:</label>
        <input type="text" posicionamento_cilindros="posicionamento_cilindros" required>
        <br><br>
        <label for="cilindros">Quantidade de Cilindros:</label>
        <input type="number" cilindros="cilindros" required>
        <br><br>
        <label for="litragem">Litragem:</label>
        <input type="number" litragem="litragem" required>
        <br><br>
        <label for="obs">Observacoes:</label>
        <input type="text" obs="obs" >
        <br><br>
        <button type="submit">Inserir Carro</button>
    </form>

    <h3>Excluir Carro</h3>
    <form id="FormDelete">
        <label for="IdCarro">ID do Carro:</label>
        <input type="number" IdCarro="IdCarro" required>
        <br><br>
        <label for="IdMotor">ID do Motor:</label>
        <input type="number" IdMotor="IdMotor" required>
        <br><br>
        <button type="submit">Excluir Carro</button>
    </form>

    <script>
        function loadListaCarro() {
            fetch('http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1')
                .then(response => response.json())
                .then(data => {
                    const ListaCarroElement = document.getElementById('ListaCarro');
                    ListaCarroElement.innerHTML = '';
                    data.forEach(carros => {
                        const li = document.createElement('li');
                        li.textContent = `Carro: ${carros.IdCarro} - Motor: ${carros.IdMotor}`;
                        ListaCarroElement.appendChild(li);
                    });
                })
                .catch(error => console.log(error));
        }

        document.getElementById('FormCarro').addEventListener('submit', event => {
            event.preventDefault();
            const modelo = document.getElementById('IdCarro').value;
            const motor = document.getElementById('IdMotor').value;

            fetch('http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ IdCarro, IdMotor })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Carro inserido com sucesso');
                loadListaCarro();
            })
            .catch(error => console.log(error));
        });

        // Evento de envio do formulário de exclusão de carro
        document.getElementById('FormDelete').addEventListener('submit', event => {
            event.preventDefault();
            const IdCarro = document.getElementById('IdCarro').value;

            fetch(`http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1/${IdCarro}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                console.log('Carro excluído com sucesso');
                loadCarList();
            })
            .catch(error => console.log(error));
        });

        loadListaCarro();
    </script>
</body>
</html>