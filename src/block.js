
//INICIA BLOCKCHAIN
const sha256 = require('crypto-js/sha256');
const data = require('./file')

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

const newBlockData = data;
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

export {calculateHash}