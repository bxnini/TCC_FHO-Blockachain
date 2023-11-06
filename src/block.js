
//INICIA BLOCKCHAIN
const sha256 = require('crypto-js/sha256');
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

// Encerre a conexão quando terminar
connection.end();


class Block {
    constructor(index, previousHash, timestamp, data, hash) {
        this.index = index;
        this.previousHash = previousHash.toString();
        this.timestamp = timestamp;
        this.data = data;
        this.hash = hash.toString();
    }
}

const createGenesisBlock = () => {
    return new Block(0, '0', Date.now(), 'Genesis Block', calculateHash(0, '0', Date.now(), 'Genesis Block'));
};

const calculateHash = (index, previousHash, timestamp, data) => {
    return sha256(index + previousHash + timestamp + data).toString();
};

const createNewBlock = (previousBlock, data) => {
    const index = previousBlock.index + 1;
    const timestamp = Date.now();
    const hash = calculateHash(index, previousBlock.hash, timestamp, data);
    return new Block(index, previousBlock.hash, timestamp, data, hash);
};

const blockchain = [createGenesisBlock()];



//CRIA NOVO BLOCO

const newBlockData = 'Dados do novo bloco';
const newBlock = createNewBlock(blockchain[blockchain.length - 1], newBlockData);
blockchain.push(newBlock);

//VALIDA BLOCKCHAIN

const isBlockValid = (newBlock, previousBlock) => {
    if (previousBlock.index + 1 !== newBlock.index) {
        return false;
    } else if (previousBlock.hash !== newBlock.previousHash) {
        return false;
    } else if (calculateHash(newBlock.index, newBlock.previousHash, newBlock.timestamp, newBlock.data) !== newBlock.hash) {
        return false;
    }
    return true;
};

const isValidChain = (chain) => {
    for (let i = 1; i < chain.length; i++) {
        if (!isBlockValid(chain[i], chain[i - 1])) {
            return false;
        }
    }
    return true;
};

//INTERAGIR COM A BLOCKCHAIN

console.log(blockchain);

const newData = 'Novos dados para o bloco 2';
const newBlock2 = createNewBlock(blockchain[blockchain.length - 1], newData);
blockchain.push(newBlock2);

console.log('É a cadeia válida?', isValidChain(blockchain));