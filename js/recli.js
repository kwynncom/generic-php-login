require('./utils.js');
const res = dangerousCharRE();
const regex = RegExp(res);

const argv = process.argv;

if (!argv || !argv.length || argv.length < 3) die('bad args');

if (!regex.test(argv[2])) die('regex fails');

kwl('OK');
