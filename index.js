const Eth = require('ethjs');
const argv = require('yargs').argv;
const ethers = require('ethers');
var Web3 = require('web3');

switch (argv._[0] || '') {
  case 'sign':
    if (!argv.privateKey || !argv.tx || !argv.rpcEndpoint) {
      process.stdout.write('ERROR: Missing required parameters');
      return process.exit(1);
    }

    var web3 = new Web3(argv.rpcEndpoint);

    web3.eth.accounts.signTransaction(
      JSON.parse(argv.tx),
      argv.privateKey,
      ((error, result) => {
        if (error) {
          process.stdout.write('ERROR: ' + error.message || 'ERROR: An unknown error has occurred signing this transaction')
        }
        process.stdout.write(result.rawTransaction)
      }));
    
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
  case 'verifyMessage':
    if (!argv.message || !argv.signature) {
      console.error('Missing required parameters');
      return process.exit(1);
    }
    const verifiedAddress = ethers.utils.verifyMessage(argv.message, argv.signature);
    process.stdout.write(verifiedAddress);
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
