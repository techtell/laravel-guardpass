<!DOCTYPE html>
<html>

<head>
    <title>Guard Pass</title>
    <style>
        html,
        body,
        h1,
        h2 {
            margin: 0;
            padding: 0;
            font-family: 'Merriweather', serif;
        }

        header {
            padding: 16px;
            border-bottom: 1px solid #d9d9d9;
            background-color: #f3f1f1;
        }

        header h1 {
            font-weight: normal;
        }
    </style>

    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">Laravel Guard Pass</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Select
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <span class="dropdown-item">
                    <input value="" type="checkbox" checked disabled /> id
                </span>
                @foreach ($columns_ as $column)
                @if ($column == 'id')
                    @continue
                @endif
                <span class="dropdown-item">
                    @if (in_array($column, $columns))
                    <input value="{{ $column }}" type="checkbox" checked />
                    @else
                    <input value="{{ $column }}" type="checkbox" />
                    @endif
                    {{ $column }}
                </span>
                @endforeach
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <table class="table">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                    <th scope="col">{{ $column }}</th>
                    @endforeach
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        // Main
        refreshTable();

        $('.dropdown').on('hide.bs.dropdown', function(e) {
            if (e.clickEvent.target.className == 'dropdown-item') {
                toggle(e.clickEvent.target.firstElementChild);
                return false;
            }

            refreshTable();
        })

        async function refreshTable() {
            const responseJson = await getUsers();
            reDrawTable(responseJson);
            reBuildEventListeners();
        }

        async function useUser(user_id) {
            const response = await fetch(`/guardpass/user/${user_id}`, {
                method: 'GET', // *GET, POST, PUT, DELETE, etc.
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                redirect: 'manual', // manual, *follow, error
            });
        }

        async function getUsers() {
            const columnsList = getColumnsList();
            const response = await fetch(`/guardpass/json/columns:${columnsList}`, {
                cache: 'no-cache',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            return response.json();
        }

        function reDrawTable(json) {
            const thead = document.querySelector('table thead');
            const tbody = document.querySelector('table tbody');
            thead.innerHTML = '';
            tbody.innerHTML = '';

            let columns = [...json.columns];
            columns.push('Action');

            const tRow = thead.insertRow();
            for (const column of columns) {
                const headerCell = document.createElement("TH");
                headerCell.innerHTML = column;
                tRow.appendChild(headerCell);
            }

            for (const row of json.data) {
                const tRow = tbody.insertRow();
                for (const column of json.columns) {
                    tRow.insertCell().innerHTML = row[column];
                }
                tRow.insertCell().appendChild(stringToHTML(createActionTableCell(row.id)));
            }
        }

        function reBuildEventListeners() {
            const elements = document.querySelectorAll('.use-user');
            for (const element of elements) {
                element.addEventListener('click', function(e) {
                    return false;
                });
            }
        }

        function getColumnsList() {
            return Array.prototype.map.call(document.querySelectorAll('input:checked'), item => {
                return item.value;
            });
        }

        function stringToHTML(htmlStr) {
            let frag = document.createDocumentFragment(),
                temp = document.createElement('div');
            temp.innerHTML = htmlStr;
            while (temp.firstChild) {
                frag.appendChild(temp.firstChild);
            }
            return frag;
        }

        function createActionTableCell(id) {
            return `<a href="#" class="use-user" onClick="useUser(${id}); return false;">Impersonate</a> | <a href="/guardpass/user/${id}" target="_blank">New Tab</a>`;
        }

        function toggle(target) {
            if (target.type == 'checkbox') {
                target.checked = target.checked == false ? true : false;
            }
        }
    </script>
</body>

</html>