<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Dream Skin Nepal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
        <main class="flex-1">
            <section class="pt-12">
                <div class="px-3 md:px-6 text-center">
                    <div class="space-y-4">
                        <h1 class="text-4xl font-bold tracking-tighter sm:text-5xl md:text-6xl">
                            #<span class="text-[#ff007f]">Genuinely</span><span class="text-[#00adef]">Authentic</span>
                        </h1>
                        <p
                            class="mx-auto max-w-[750px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                            Discover the beauty of genuine and authentic products from
                            Dream Skin Nepal.
                        </p>
                        <q class="mx-auto max-w-[700px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">Journey to your <span class="text-[#ff007f] font-bold">Dream</span> <span class="text-[#00adef] font-bold">Skin</span> starts here</q>
                    </div>
                </div>
            </section>
            <section class="w-full grid place-items-center">
                <div class="md:px-20 px-4 gap-6 py-12">
                    <div class="flex flex-col justify-center space-y-4">
                        <h3 class="text-3xl font-bold tracking-tighter sm:text-4xl text-[#00adef] text-center md:text-start">Meet our Team</h3>
                        <p class="text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed text-center md:text-start">
                            Our team of dedicated professionals is passionate about
                            bringing the best of Nepalese skincare to the world. From our
                            founders to our product developers and customer service
                            representatives, we are committed to delivering exceptional
                            products and experiences.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            <div class="flex items-center gap-4 shadow-md py-2 p-2 rounded-lg">
                                <img class="h-[80px] w-[80px] object-cover rounded-full" src="Dilip Kumar Yadav.jpg" />
                                <div>
                                    <p class="text-sm font-medium leading-none">
                                        Dilip Kumar Yadav
                                    </p>
                                    <p class="text-sm text-muted-foreground">Chief Executive Officer (CEO)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 shadow-md py-2 p-2 rounded-lg">
                                <img class="h-[80px] w-[80px] object-cover rounded-full" src="rajul shrestha.webp" />
                                <div>
                                    <p class="text-sm font-medium leading-none">
                                        Rajul Shrestha
                                    </p>
                                    <p class="text-sm text-muted-foreground">Chief Executive Officer (CEO)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 shadow-md py-2 p-2 rounded-lg">
                                <img class="h-[80px] w-[80px] object-cover rounded-full"
                                    src="https://picsum.photos/200/550" />
                                <div>
                                    <p class="text-sm font-medium leading-none">
                                        Asmita Sah
                                    </p>
                                    <p class="text-sm text-muted-foreground">Chief Executive Officer (CEO)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 shadow-md py-2 p-2 rounded-lg">
                                <img class="h-[80px] w-[80px] object-cover rounded-full"
                                    src="https://picsum.photos/200/500" />
                                <div>
                                    <p class="text-sm font-medium leading-none">
                                        Simran Joshi Shrestha
                                    </p>
                                    <p class="text-sm text-muted-foreground">Chief Executive Officer (CEO)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 shadow-md py-2 p-2 rounded-lg">
                                <img class="h-[80px] w-[80px] object-cover rounded-full"
                                    src="https://picsum.photos/200/600" />
                                <div>
                                    <p class="text-sm font-medium leading-none">
                                        Archana Bam
                                    </p>
                                    <p class="text-sm text-muted-foreground">Sales Department</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="w-full grid place-items-center">
                <div class="md:px-20 px-4 gap-6 pt-12">
                    <div class="space-y-4">
                        <div class="space-y-4">
                            <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl text-[#00adef] text-center md:text-start">
                                Our Achievements
                            </h2>
                            <p
                                class="text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed text-center md:text-start">
                                Since our founding, DreamSkin Nepal has been recognized for
                                our commitment to quality, sustainability, and innovation. We
                                are proud to have received several awards and certifications
                                that validate our dedication to providing the best possible
                                skincare products.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                            <div class="flex flex-col items-center justify-center p-4 bg-muted rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="#ff007f" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-8 h-8 text-primary">
                                    <path
                                        d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                                    </path>
                                    <circle cx="12" cy="8" r="6"></circle>
                                </svg>
                                <p class="text-sm text-center font-medium mt-2">
                                    Best Natural Skincare Brand
                                </p>
                                <p class="text-xs text-muted-foreground">2021</p>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 bg-muted rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="#ff007f" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-8 h-8 text-primary">
                                    <path
                                        d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z">
                                    </path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                                <p class="text-sm text-center font-medium mt-2">Certified Organic</p>
                                <p class="text-xs text-muted-foreground">2022</p>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 bg-muted rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="#ff007f" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-8 h-8 text-primary">
                                    <path
                                        d="M7 19H4.815a1.83 1.83 0 0 1-1.57-.881 1.785 1.785 0 0 1-.004-1.784L7.196 9.5">
                                    </path>
                                    <path
                                        d="M11 19h8.203a1.83 1.83 0 0 0 1.556-.89 1.784 1.784 0 0 0 0-1.775l-1.226-2.12">
                                    </path>
                                    <path d="m14 16-3 3 3 3"></path>
                                    <path d="M8.293 13.596 7.196 9.5 3.1 10.598"></path>
                                    <path
                                        d="m9.344 5.811 1.093-1.892A1.83 1.83 0 0 1 11.985 3a1.784 1.784 0 0 1 1.546.888l3.943 6.843">
                                    </path>
                                    <path d="m13.378 9.633 4.096 1.098 1.097-4.096"></path>
                                </svg>
                                <p class="text-sm text-center font-medium mt-2">Sustainable Packaging</p>
                                <p class="text-xs text-muted-foreground">2023</p>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 bg-muted rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="#ff007f" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-8 h-8 text-primary">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 16v-4"></path>
                                    <path d="M12 8h.01"></path>
                                </svg>
                                <p class="text-sm text-center font-medium mt-2">
                                    Most Innovative Skincare
                                </p>
                                <p class="text-xs text-muted-foreground">2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="md:px-20 px-4 py-12">
                <div class="px-4 md:px-6 space-y-4">
                    <div class="space-y-4">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl text-[#00adef] text-center md:text-start">
                            Find Our Stores
                        </h2>
                        <p class="text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed text-center md:text-start">
                            Visit one of our two convenient locations to shop our latest
                            collection in person.
                        </p>
                    </div>
                    <div class="grid place-items-center">
                        <div class="inset-0 flex items-center justify-center md:gap-24 gap-8 flex-wrap p-4">
                            <div>
                                <h3 class="text-xl font-bold mb-2">
                                    Baneshwor
                                </h3>
                                <div class="border overflow-hidden border-[#00adef] rounded-3xl">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.621402209938!2d85.3356978751235!3d27.698094025900176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1926fcb220d7%3A0xa7afb64531f2dbc6!2sDream%20Skin%20Nepal%20%7C%20Korean%20Skincare%2C%20K%20Beauty%20%26%20Makeup!5e0!3m2!1sen!2snp!4v1722960176922!5m2!1sen!2snp"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        class="w-[75vw] md:w-[400px] h-[200px] md:w-[270px]"></iframe>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">
                                    Lazimpat
                                </h3>
                                <div class="border overflow-hidden border-[#00adef] rounded-3xl">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.621402209938!2d85.3356978751235!3d27.698094025900176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1926fcb220d7%3A0xa7afb64531f2dbc6!2sDream%20Skin%20Nepal%20%7C%20Korean%20Skincare%2C%20K%20Beauty%20%26%20Makeup!5e0!3m2!1sen!2snp!4v1722960176922!5m2!1sen!2snp"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        class="w-[75vw] md:w-[400px] h-[200px] md:w-[270px]"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer>
        <?php
        include_once $base_url . 'Assets/Components/Footer.php';
        ?>
    </footer>
</body>

</html>