require('./utils.js');
const res = dangerousCharRE();
const regex = RegExp(res);
if (regex.test('{')) console.log('OK');
else console.log('bad');
if (regex.test('hi')) console.log('OK');
else console.log('bad');
