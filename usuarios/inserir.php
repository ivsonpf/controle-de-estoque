<?php
require_once __DIR__ . '/../config.php';

$mensagem_popup = ""; // Variável para guardar a mensagem do popup

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if ($nome && $email && $senha) {
        
        
        $sql_busca = "SELECT nome, email FROM usuarios WHERE nome = :nome OR email = :email";
        $stmt_busca = $conexao->prepare($sql_busca);
        $stmt_busca->execute([
            ':nome'  => $nome,
            ':email' => $email
        ]);
        $usuario_existente = $stmt_busca->fetch(PDO::FETCH_ASSOC);

        if ($usuario_existente) {
        
            if ($usuario_existente['email'] === $email) {
                $mensagem_popup = "Erro: O e-mail '$email' já está cadastrado!";
            } else {
                $mensagem_popup = "Erro: O nome '$nome' já está em uso!";
            }
        } else {
            
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conexao->prepare($sql);
            
            $stmt->execute([
                ':nome'  => $nome,
                ':email' => $email,
                ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ]);

            header('Location: ' . BASE_URL . '/usuarios/listar.php');
            exit;
        }
    } else {
        $mensagem_popup = "Por favor, preencha todos os campos.";
    }
}

$titulo = "Adicionar Usuário |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Usuário</h3>

    <form method="post" class="w-75 mx-auto">
        <div class="form-group mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" id="nome" value="<?= htmlspecialchars($nome ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" name="senha" class="form-control" id="senha" required>
        </div>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i> Salvar</button>
    </form>
</section>

<?php if (!empty($mensagem_popup)): ?>
    <script>
        alert("<?php echo $mensagem_popup; ?>");
    </script>
<?php endif; ?>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>