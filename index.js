const Eth = require('ethjs');
const argv = require('yargs').argv;

const ethers = require('ethers');
const sign = require('ethjs-signer').sign;

switch (argv._[0] || '') {
  case 'sign':
    if (!argv.privateKey || !argv.tx) {
      console.error('Missing required parameters');
      return process.exit(1);
    }

    // Sign the transaction
    const tx = JSON.parse(argv.tx),
      signedTx = sign(tx, argv.privateKey);

    process.stdout.write(signedTx);
    break;
  case 'recoverAddress':
    if (!argv.message || !argv.signature) {
      console.error('Missing required parameters');
      return process.exit(1);
    }
    const msgHash = ethers.utils.hashMessage(argv.message);
    const msgHashBytes = ethers.utils.arrayify(msgHash);
    const recoveredAddress = ethers.utils.recoverAddress(msgHashBytes, argv.signature);
    process.stdout.write(recoveredAddress);
    break;
  case 'sha3':
    if (!argv.str) {
      console.error('Missing required parameters');
      return process.exit(1);
    }
    process.stdout.write(Eth.keccak256(argv.str));
    break;
    default:
      process.exit(1);

}