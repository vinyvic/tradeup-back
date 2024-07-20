<x-layout>
    <form id="form-cep" class="mx-auto max-w-sm">
        <div class="mb-5">
            <label
                for="cep"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Digite o CEP
            </label>
            <input
                type="text"
                id="cep"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="00000-000"
                required />
        </div>
        <button
            type="submit"
            class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">
            Buscar
        </button>
        <a
            href="{{ route('home') }}"
            type="button"
            class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
            Voltar
        </a>
    </form>
    {{-- Endereço --}}
    <div class="mx-auto mt-3 max-w-sm">
        <div class="mb-5">
            <label
                for="cidade"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Cidade
            </label>
            <input
                type="text"
                id="cidade"
                disabled
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
        </div>
        <div class="mb-5">
            <label
                for="bairro"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Bairro
            </label>
            <input
                type="text"
                id="bairro"
                disabled
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
        </div>
        <div class="mb-5">
            <label
                for="logradouro"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Logradouro
            </label>
            <input
                type="text"
                id="logradouro"
                disabled
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
        </div>
        <div class="mb-5">
            <label
                for="complemento"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Complemento
            </label>
            <input
                type="text"
                id="complemento"
                disabled
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
        </div>
    </div>
    @vite(['node_modules/imask/dist/imask.js'])
    <script>
        let token = '';

        async function getToken() {
            const userEmail = 'test@example.com';
            const userPassword = 'password';

            const tokenResponse = await fetch(
                'http://localhost:8000/api/tokens/create',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                    },
                    body: JSON.stringify({
                        email: userEmail,
                        password: userPassword,
                        device_name: 'web',
                    }),
                }
            );

            if (tokenResponse.ok) {
                const tokenReponseJson = await tokenResponse.json();
                token = tokenReponseJson.token;
            }
            else {
                const response = await tokenResponse.json();
                alert(response.message);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const element = document.getElementById('cep');
            const maskOptions = {
                mask: '00000-000',
            };
            const mask = IMask(element, maskOptions);

            document
                .getElementById('form-cep')
                .addEventListener('submit', async function (event) {
                    event.preventDefault();
                    const cep = mask.unmaskedValue;

                    // Get Token
                    await getToken();

                    if (token) {
                        const res = fetch('api/cep/' + cep, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                Accept: 'application/json',
                                Authorization: 'Bearer ' + token,
                            },
                        })
                            .then((res) => res.json())
                            .then((res) => {
                                if (res.cep) {
                                    document.getElementById('cidade').value =
                                        res.localidade;
                                    document.getElementById('bairro').value =
                                        res.bairro;
                                    document.getElementById(
                                        'logradouro'
                                    ).value = res.logradouro;
                                    document.getElementById(
                                        'complemento'
                                    ).value = res.complemento;
                                } else if (res.message) {
                                    alert(res.message);
                                }
                            });
                    }
                });
        });
    </script>
</x-layout>
