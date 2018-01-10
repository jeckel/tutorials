

const promiseResolve = () => new Promise((resolve) => resolve('success'));

const promiseReject = () => new Promise((_, reject) => reject('failure'));

describe('Test a promise -', () => {
    test('Promise that should resolve', async () => {
        expect.assertions(1);
        await expect(promiseResolve()).resolves.toEqual('success');
    });

    test('Promise that should reject', async () => {
        expect.assertions(1);
        await expect(promiseReject()).rejects.toEqual('failure');
    })
});
