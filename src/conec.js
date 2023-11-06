const mysql = require('mysql');

// Configurações da conexão com o banco de dados
const dbConfig = {
  host: 'localhost',     // Endereço do servidor MySQL
  user: 'root',    // Nome de usuário
  password: '', // Senha
  database: 'test'  // Nome do banco de dados
};

// Crie uma conexão com o MySQL
const connection = mysql.createConnection(dbConfig);

// Conecte ao banco de dados
connection.connect((err) => {
  if (err) {
    console.error('Erro ao conectar ao MySQL: ' + err.stack);
    return;
  }
  console.log('Conexão bem-sucedida ao MySQL como ID ' + connection.threadId);

  // Execute consultas ou outras operações aqui
});


const novoRegistro = { teste: 'Exemplo'};

connection.query('INSERT INTO teste SET ?', novoRegistro, (err, result) => {
    if (err) {
      console.error('Erro ao inserir dados: ' + err);
      return;
    }
    console.log('Dados inseridos com sucesso. ID do novo registro: ' + result.insertId);
  });

// Encerre a conexão quando terminar
connection.end();