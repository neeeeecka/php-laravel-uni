<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Document</title>
    <style>
    .pen {
        margin-left: 5px;
    }

    body {}

    .json {
        display: none;
    }
    </style>
</head>

<body>
    <div class="container pt-3">
        <div>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="searchInput" class="col-form-label">Search Users table:</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" />
                </div>
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        Don't even need submit. (Requests are throttled to 1/350ms)
                    </span>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">
                Insert new user
            </button>
        </div>
        <div class="row mt-4" id="searchResult">
            <?php include("select.php") ?>
        </div>
        <div class="row">
            <h5>SSR შევინარჩუნე!!! :დ</h5>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="insertModal">
        <form method="POST" action="insert.php">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Insertion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?php include("usermodal.php") ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addButton">Add user</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" tabindex="-2" id="updateModal">
        <form method="POST" action="update.php">
            <input type="hidden" value="" name="id" id="u_id" />
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="closeUpdateModal"></button>
                    </div>
                    <?php $idPrefix = "u_"; include("usermodal.php") ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeUpdateModal2"
                            data-toggle="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addButton">Update user</button>
                    </div>
                </div>
            </div>
        </form>

    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<script type="module">
import useThrottler from "./useThrottler.js";
import {
    autodefine
} from "./autodefine.js";

const defined = autodefine();

const {
    searchInput,
    searchResult,
    closeUpdateModal,
    closeUpdateModal2,
} = defined;

const {
    withThrottler
} = useThrottler();

const onChange = (e) => {
    const value = e.target.value;

    withThrottler(() => {
        fetch(`select.php?search=${value}`).then(async (response) => {
            // console.log("Called", value);
            const text = await response.text();
            searchResult.innerHTML = text;

            const jsonSpans = document.querySelectorAll(".json");
            const json = `[${[...jsonSpans].map(span => span.innerHTML).join(",")}]`;
            const data = JSON.parse(json);
            data.forEach(row => {
                const button = document.getElementById(`btnu_${row.id}`);
                button.addEventListener("click", () => {
                    u_id.value = row.id;
                    u_name.value = row.name;
                    u_surname.value = row.surname;

                    const [yyyy, mm, dd] = row.birthday.split(" ")[0].split(
                        "-");

                    u_dd.value = dd;
                    u_mm.value = mm;
                    u_yyyy.value = yyyy;
                });
            });
        });
    });
};

onChange({
    target: {
        value: ""
    }
});

searchInput.addEventListener("keyup", onChange);
searchInput.addEventListener("change", onChange);

const hideModal = () => {
    const modal = new bootstrap.Modal(document.getElementById("updateModal"), {});
    // console.log(modal)
    // modal.hide();
}

// closeUpdateModal.addEventListener("click", hideModal);
// closeUpdateModal2.addEventListener("click", hideModal);


// addButton.addEventListener("click", onAdd);
</script>

</html>