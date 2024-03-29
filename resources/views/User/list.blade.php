<x-app-layout>
    <style>
        div.dataTables_length select {
            width: 70px;
        }
        </style>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="display cell-border compact stripe" id="users">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-Mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="POST" id='form_delete'>
        <input type="hidden" name="_method" value="DELETE" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <script>
        function distroy(id) {
            swal({
                    title: "Tem certeza?",
                    text: "Deseja realmente desativar este usuário?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        cancel: {
                            text: "Cancelar",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Confirmar",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    },
                })
            .then(willDelete => {
                if (willDelete) {
                    var form = document.querySelector('#form_delete');
                    form.action=`/user/${id}`;
                    form.submit();
                    console.log(form);
                }
            });

        }

        $(document).ready(function(){

            function factoryButton(id, icon, color, rota='#', label='')
            {
                if (rota=='#') {
                    var url_button = `<a onclick="distroy(${id})" class="text-${color}-700 border border-${color}-700 hover:bg-${color}-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-${color}-300 font-medium rounded-lg p-2.5 text-center inline-flex items-center me-2 dark:border-${color}-500 dark:text-${color}-500 dark:hover:text-white dark:focus:ring-${color}-800 dark:hover:bg-${color}-500" href="${rota}"><i class="fa fa-1g ${icon}" aria-hidden="true"></i>${label}</a>`;
                } else {
                    var url_button = `<a class="text-${color}-700 border border-${color}-700 hover:bg-${color}-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-${color}-300 font-medium rounded-lg p-2.5 text-center inline-flex items-center me-2 dark:border-${color}-500 dark:text-${color}-500 dark:hover:text-white dark:focus:ring-${color}-800 dark:hover:bg-${color}-500" href="${rota}"><i class="fa fa-1g ${icon}" aria-hidden="true"></i>${label}</a>`;
                }

                return url_button;
            }

            var table = new DataTable('#users', {
                dom: 'fB<"pt-4"l>trpli',
                pagingType: 'full_numbers',
                scrollCollapse: true,
                scrollY: '50vh',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                },
                serverSide: true,
                processing: true,
                paging: true,
                searching: { "regex": true },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                pageLength: 10,
                ajax: {
                    url: "{{ route('users.list') }}",
                    deferRender: true
                },
                columns: [
                    { data:'name' },
                    { data:'email' },
                    {
                        data: "id", "render": function (id) {
                            return factoryButton(id, 'fa-pencil-square-o', 'green',`/user/${id}/edit`) + factoryButton(id, 'fa-ban', 'red','#');
                        }
                    }
                ],
                buttons: [
                    {
                        text: '<i class="text-purple-600 fa fa-1g fa-user-plus"></i>',
                        titleAttr: 'Adicionar Usuário',
                        className: 'bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "{{ route('register') }}";
                        }
                    },
                    {
                        className: 'bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded',
                        extend: 'copy',
                        text: '<i class="text-white fa fa-1g fa-files-o"></i>',
                        titleAttr: 'Copiar para a Área de Transferencia'
                    },
                    {
                        className: 'bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded',
                        extend:'excel',
                        text: '<i class="text-green-600 fa fa-1g fa-file-excel-o"></i>',
                        titleAttr: 'Exportar para Excel'
                    },
                    {
                        className: 'bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded',
                        extend:'pdf',
                        text: '<i class="text-red-600 fa fa-1g fa-file-pdf-o"></i>',
                        titleAttr: 'Exportar para DPF'
                    },
                ],
            });
        });
    </script>

</x-app-layout>
