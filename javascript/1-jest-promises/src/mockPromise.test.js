const foo = async (cb) => {
    try {
        return await cb();
    } catch(err) {
        throw err;
    }
};


describe('Test a function which use a Promise-', () => {
    test('Promise resolve should succeed', () => {
        const cb = () => new Promise(resolve => resolve('success'));

        expect.assertions(1);

        console.log(foo(cb));
        expect(foo(cb)).toEqual('success');
    });

    test('Promise reject should failed', () => {
        const cb = () => new Promise((resolve, reject) => reject('failure'));
        expect.assertions(1);

        console.log(foo(cb));
        expect(foo(cb)).toEqual('failure');
    });

});
