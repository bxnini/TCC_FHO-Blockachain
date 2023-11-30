import mysql from 'mysql2';
import sha256 from 'crypto-js/sha256';

const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'block'
};

const connection = mysql.createConnection(dbConfig);

connection.connect((err) => {
  if (err) {
    console.error('Erro ao conectar ao MySQL: ' + err.stack);
    return;
  }
  console.log('Conexão bem-sucedida ao MySQL como ID ' + connection.threadId);

  const previousHash = connection.query('select previousHash from blocs order by previousHash desc limit 1; ');
  const timestamp = new Date().toISOString();
  const data = 'SeusDadosAqui';

  const calculateHash = (index, previousHash, timestamp, data) => {
    return sha256(index + previousHash + timestamp + data).toString();
  };

  const hash = calculateHash(0, previousHash, timestamp, data);

  const novoRegistro = { previousHash: previousHash, data: data, hash: hash };

  connection.query('INSERT INTO blocks SET ?', novoRegistro, (err, result) => {
    if (err) {
      console.error('Erro ao inserir dados: ' + err);
      return;
    }
    console.log('Dados inseridos com sucesso. ID do novo registro: ' + result.insertId);
  });

  connection.end();
});