const argv = require('yargs')
    .argv;

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
    default:
        process.exit(1);

}
