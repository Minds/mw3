const ethers = require('ethers');

const yargs = require('yargs');
const argv = yargs
  .option('privateKey', {
      string: true
  })
  .option('signature', {
    string: true
  })
  .argv;

switch (argv._[0] || '') {
  case 'sign':

    if (!argv.privateKey || !argv.tx) {
      console.error('Missing required parameters');
      return process.exit(1);
    }

    // Wallet
    const wallet = new ethers.Wallet(argv.privateKey);

    // Deserialize the input
    const tx = JSON.parse(argv.tx);

    // Sign the transaction
    const signedTx = wallet.signTransaction(tx)
      .then(signedTx => process.stdout.write(signedTx))
      .catch(err => console.error(err));
    break;
  case 'recoverAddress':
    if (!argv.message || !argv.signature) {
      console.error('Missing required parameters');
      return process.exit(1);
    }
    const msgHash = ethers.hashMessage(argv.message);
    const msgHashBytes = ethers.getBytes(msgHash);
    const recoveredAddress = ethers.recoverAddress(msgHashBytes, argv.signature);
    process.stdout.write(recoveredAddress);
    break;
  case 'verifyMessage':
    if (!argv.message || !argv.signature) {
      console.error('Missing required parameters');
      return process.exit(1);
    }

    const verifiedAddress = ethers.verifyMessage(argv.message, argv.signature);
    process.stdout.write(verifiedAddress);
    break;
  case 'sha3':
    if (!argv.str) {
      console.error('Missing required parameters');
      return process.exit(1);
    }
    process.stdout.write(ethers.keccak256(ethers.toUtf8Bytes(argv.str)));
    break;
    default:
      process.exit(1);

}