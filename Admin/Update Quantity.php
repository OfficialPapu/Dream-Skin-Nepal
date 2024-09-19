<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Assets/CSS/Update Quantity.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Update Product Quantity</title>
</head>

<body class="bg-[#e5f0f9]">
    <div class="!mt-[90px] md:px-0 px-2">
        <div class="container mx-auto px-4 pt-12 pb-8 max-w-3xl bg-[white] rounded-lg UpdateData" id="MainBox">
            <div class="grid gap-8">
                <div>
                    <h1 class="text-3xl font-bold text-[#ff007f]">Update Product Quantity</h1>
                    <p class="text-muted-foreground mt-0.5">
                        Upload an Excel file to update your product database.
                    </p>
                </div>
                <form enctype="multipart/form-data">
                    <label class="text-xs text-gray-500">Select an Excel file (.xlsx, .csv)</label>

                    <div class="grid grid-cols-[1fr_auto] gap-4">
                        <input
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                            accept=".xlsx, .csv, .ods" placeholder="Choose an Excel file" type="file" name="ExcelFile" />
                        <button
                            class="w-[100px] grid place-items-center font-medium focus-visible:outline-none bg-[#00adef]/85 text-white hover:bg-[#00adef] h-10 px-4 py-2 rounded-lg duration-300"
                            id="Update">
                            Update
                        </button>
                    </div>
                </form>
                <div id="Output" class="hidden"></div>
                <div>
                    <h2 class="text-xl font-bold text-[#ff007f]" id="ErrorTitle">Excel File Format</h2>
                    <p class="text-muted-foreground mt-0.5 mb-3" id="ErrorDoc">
                        The Excel file should include the following columns in this order:
                    </p>
                    <table class="border border-gray-300 border-collapse w-full">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-[1rem]">ID</th>
                                <th class="border border-gray-300 px-4 py-[1rem]">Product Title</th>
                                <th class="border border-gray-300 px-4 py-[1rem]" id="ErrorBox">Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">P0201</td>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">
                                    Revive Serum : Ginseng + Snail Mucin 30Ml
                                </td>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">5</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">P0202</td>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">
                                    Revive Serum : Ginseng + Snail Mucin 30Ml
                                </td>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">4</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">P0206</td>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">
                                    Revive Serum : Ginseng + Snail Mucin 30Ml
                                </td>
                                <td class="border border-gray-300 px-4 py-[1rem] text-[12px]">2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="Assets/JS/Update Quantity.js"></script>

</html>