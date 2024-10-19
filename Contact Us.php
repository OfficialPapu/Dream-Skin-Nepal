<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body>
    <div id="root">
        <section class="w-full px-6 pt-8 mx-auto max-w-7xl dark:bg-black md:px-8 md:py-20">
            <div class="w-full h-full grid grid-cols-1 gap-16 md:grid-cols-2">
                <div class="w-full flex flex-col gap-8 justify-between">
                    <div class="w-full flex flex-col md:gap-10 gap-4">
                        <h1
                            class="w-full text-4xl font-semibold text-black dark:text-slate-50 md:text-6xl">
                            Get in Touch with <span class="text-[#00adef]">Dream</span> <span class="text-[#ff007f]">Skin</span> Nepal
                        </h1>
                        <div class="w-full flex items-center gap-10">
                            <div class="w-auto flex flex-col gap-2">
                                <p class="text-[#ff007f] font-bold text-6xl">30+</p>
                                <p class="w-full text-black font-semibold dark:text-slate-50 text-sm">Skincare Experts</p>
                            </div>
                            <div class="relative w-auto flex items-center -space-x-5">
                                <div
                                    class="z-[10] w-[4.2rem] h-[4.2rem] aspect-[1/1] rounded-full object-cover shadow-md">
                                    <img class="IMAGE w-full h-full rounded-full border-[3px] border-white bg-zinc-200 object-cover"
                                        alt="designer_avatars_0"
                                        src="https://images.unsplash.com/photo-1488228469209-c141f8bcd723?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&h=800">
                                </div>
                                <div
                                    class="z-[11] w-[4.2rem] h-[4.2rem] aspect-[1/1] rounded-full object-cover shadow-md">
                                    <img class="IMAGE w-full h-full rounded-full border-[3px] border-white bg-zinc-200 object-cover"
                                        alt="designer_avatars_1"
                                        src="https://images.unsplash.com/photo-1552046122-03184de85e08?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&h=800">
                                </div>
                                <div
                                    class="z-[12] w-[4.2rem] h-[4.2rem] aspect-[1/1] rounded-full object-cover shadow-md">
                                    <img class="IMAGE w-full h-full rounded-full border-[3px] border-white bg-zinc-200 object-cover"
                                        alt="designer_avatars_2"
                                        src="https://images.unsplash.com/photo-1484328861630-cf73b7d34ea3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&h=800">
                                </div>
                                <div
                                    class="z-[13] w-[4.2rem] h-[4.2rem] aspect-[1/1] rounded-full object-cover shadow-md">
                                    <img class="IMAGE w-full h-full rounded-full border-[3px] border-white bg-zinc-200 object-cover"
                                        alt="designer_avatars_3"
                                        src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&h=800">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex flex-col gap-10">
                        <button
                            class="w-fit h-12 px-6 group text-sm font-semibold flex gap-2 items-center rounded-full bg-[#00adef] hover:bg-[#ff007f] hover:transition-all hover:duration-300 md:px-8 md:h-14 md:text-base text-white">
                            Contact Us
                            <div class="group-hover:translate-x-1 transition-transform">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </button>
                        <p class="DESC text-slate-600 dark:text-slate-400">For any inquiries, feedback, or support, our
                            team is here to help you achieve your dream skin.</p>
                    </div>
                </div>
                <div>
                    <div class="relative w-full h-[26rem] md:h-[36rem]">
                        <div class="w-full h-full flex items-center justify-center relative">
                            <div
                                class="relative w-full h-full overflow-hidden rounded-[2rem] rounded-tl-[6rem] rounded-br-[6rem]">
                                <img class="IMAGE w-full h-full bg-black/10 dark:bg-white/10 object-cover"
                                    alt="team_image"
                                    src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&h=1000">
                                <div
                                    class="absolute bottom-0 w-full flex flex-col gap-3 justify-end p-10 bg-gradient-to-t from-black/60">
                                    <div class="TITLE-PRIMARY w-full text-xl text-zinc-50 font-semibold md:text-2xl">Our
                                        Skincare Team</div>
                                    <div class="DESC w-full text-sm text-zinc-50 font-light md:text-base">Our dedicated
                                        team of skincare professionals is here to support you in achieving your best
                                        skin.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="bg-white py-16 sm:py-12 relative dark:bg-slate-800">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto max-w-2xl space-y-16 divide-y divide-black/10 dark:divide-white/10 lg:mx-0 lg:max-w-none">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-slate-50">
                                Stay Connected
                            </h2>
                            <p class="mt-4 leading-7 text-slate-600 dark:text-slate-300">
                                Reach out to us for any questions or support. We're here to help you with all your
                                skincare needs.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                            <div class="rounded-2xl shadow p-10">
                                <h3 class="text-base font-semibold leading-7 text-slate-900 dark:text-slate-200">
                                    <i class="fa-solid fa-headset"></i> Customer Support
                                </h3>
                                <div class="mt-3 space-y-1 text-sm leading-6 text-slate-600 dark:text-slate-400">
                                    <button class="font-semibold text-[#00adef]">support@dreamskinnepal.com</button>
                                    <p class="mt-1">+977-9862078653</p>
                                </div>
                            </div>
                            <div class="rounded-2xl shadow p-10">
                                <h3 class="text-base font-semibold leading-7 text-slate-900 dark:text-slate-200">
                                    <i class="fa-brands fa-searchengin"></i> General Inquiry
                                </h3>
                                <div class="mt-3 space-y-1 text-sm leading-6 text-slate-600 dark:text-slate-400">
                                    <button class="font-semibold text-[#00adef]">info@dreamskinnepal.com</button>
                                    <p class="mt-1">+977-9862078653</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-8 gap-y-10 pt-16 lg:grid-cols-3">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-50">
                            Our Locations
                        </h2>
                        <p class="mt-4 leading-7 text-slate-600 dark:text-slate-300">
                            Find our stores in cities across Nepal.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                        <a href="#root">
                            <div class="rounded-2xl shadow p-10">
                                <h3 class="text-base font-semibold leading-7 text-slate-900 dark:text-slate-200">
                                    <i class="fa-solid fa-location-dot"></i> Mid Baneshwor 
                                </h3>
                                <p
                                    class="mt-3 space-y-1 text-sm not-italic leading-6 text-slate-600 dark:text-slate-400">
                                    Mid Baneshwor, Kathmandu, Nepal
                                </p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="rounded-2xl shadow p-10">
                                <h3 class="text-base font-semibold leading-7 text-slate-900 dark:text-slate-200">
                                    <i class="fa-solid fa-location-dot"></i> Lazimpat
                                </h3>
                                <p
                                    class="mt-3 space-y-1 text-sm not-italic leading-6 text-slate-600 dark:text-slate-400">
                                    Trisara Lazimpat, Kathmandu, Nepal
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="px-4 mx-auto max-w-7xl py-10 flex flex-col gap-8">
                <div>
                    <h2 class="text-4xl font-semibold text-center text-[#ff007f]">
                        Frequently Asked Questions <i class="fa-regular fa-circle-question"></i>
                    </h2>
                </div>
                <div class="max-w-5xl mx-auto flex flex-col gap-14 px-4">
                    <div class="border-b border-black/10 dark:border-white/10">
                        <p class="text-2xl font-semibold text-[#00adef]">
                            01. What products do you offer?
                        </p>
                        <p class="my-4 text-base font-normal text-slate-600 dark:text-white/70">
                            <i class="fa-solid fa-arrow-right"></i> We offer a wide range of skincare products including cleansers, moisturizers, serums, and
                            more.
                        </p>
                    </div>
                    <div class="border-b border-black/10 dark:border-white/10">
                        <p class="text-2xl font-semibold text-[#00adef]">
                            02. How can I place an order?
                        </p>
                        <p class="my-4 text-base font-normal text-slate-600 dark:text-white/70">
                            <i class="fa-solid fa-arrow-right"></i> You can place an order directly on our website or contact our customer support for
                            assistance.
                        </p>
                    </div>
                    <div class="border-b border-black/10 dark:border-white/10">
                        <p class="text-2xl font-semibold text-[#00adef]">
                            03. Can I cancel my order if I change my mind?
                        </p>
                        <p class="my-4 text-base font-normal text-slate-600 dark:text-white/70">
                            <i class="fa-solid fa-arrow-right"></i> You may cancel your order when the order is still in processing status. Only cancellation
                            requests made by the means of submitting a cancellation request will be acknowledged.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="dark:bg-slate-800">
            <div class="max-w-7xl mx-auto py-20 px-4">
                <div class="grid grid-cols-1 pb-6 text-center">
                    <h3 class="TITLE-PRIMARY text-4xl font-semibold text-slate-900 dark:text-white md:text-5xl">
                        Customer Reviews
                    </h3>
                    <p class="DESC mt-4 text-center text-slate-700 dark:text-white/70 lg:text-lg">
                        See what our customers have to say about their experience with Dream Skin Nepal.
                    </p>
                </div>
                <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-6 gap-6">
                    <div>
                        <div class="w-full h-full">
                            <div
                                class="rounded-xl h-full flex flex-col gap-8 shadow dark:shadow-gray-800 p-8 bg-white dark:bg-slate-900">
                                <div class="flex items-center pb-8 border-b border-black/10 dark:border-white/10">
                                    <img class="IMAGE h-14 w-14 rounded-full shadow dark:shadow-gray-800 object-cover aspect-[1/1]"
                                        src="https://cdn.wegic.ai/assets/onepage/ai/image/b4e62932-bb18-482a-9de9-5974d67708a8.jpeg"
                                        style="background-color: transparent;">
                                    <div class="pl-3">
                                        <button
                                            class="TEXT-LINK text-lg font-semibold text-sky-600 hover:text-sky-700 dark:hover:text-white duration-500">
                                            Aarati Shrestha
                                        </button>
                                        <p class="text-slate-500 dark:text-white/90">
                                            Customer
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-6">
                                    <p class="TEXT-CONTENT text-slate-500 dark:text-white/90">
                                        Dream Skin Nepal has transformed my skincare routine. Their products are
                                        top-notch!
                                    </p>
                                    <ul class="flex items-center gap-2 text-amber-400 text-xl">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="w-full h-full">
                            <div
                                class="rounded-xl h-full flex flex-col gap-8 shadow dark:shadow-gray-800 p-8 bg-white dark:bg-slate-900">
                                <div class="flex items-center pb-8 border-b border-black/10 dark:border-white/10">
                                    <img class="IMAGE h-14 w-14 rounded-full shadow dark:shadow-gray-800 object-cover aspect-[1/1]"
                                        src="https://cdn.wegic.ai/assets/onepage/ai/image/e6f40759-6be1-403e-ba73-5623a62043d4.jpeg"
                                        style="background-color: transparent;">
                                    <div class="pl-3">
                                        <button
                                            class="TEXT-LINK text-lg font-semibold text-sky-600 hover:text-sky-700 dark:hover:text-white duration-500">
                                            Ramesh Koirala
                                        </button>
                                        <p class="text-slate-500 dark:text-white/90">
                                            Customer
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-6">
                                    <p class="TEXT-CONTENT text-slate-500 dark:text-white/90">
                                        Excellent customer service and high-quality products. Highly recommend!
                                    </p>
                                    <ul class="flex items-center gap-2 text-amber-400 text-xl">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="w-full h-full">
                            <div
                                class="rounded-xl h-full flex flex-col gap-8 shadow dark:shadow-gray-800 p-8 bg-white dark:bg-slate-900">
                                <div class="flex items-center pb-8 border-b border-black/10 dark:border-white/10">
                                    <img class="IMAGE h-14 w-14 rounded-full shadow dark:shadow-gray-800 object-cover aspect-[1/1]"
                                        src="https://cdn.wegic.ai/assets/onepage/ai/image/0782b318-18f5-4b69-bb67-37d5499eb9d9.jpeg"
                                        style="background-color: transparent;">
                                    <div class="pl-3">
                                        <button
                                            class="TEXT-LINK text-lg font-semibold text-sky-600 hover:text-sky-700 dark:hover:text-white duration-500">
                                            Sita Gurung
                                        </button>
                                        <p class="text-slate-500 dark:text-white/90">
                                            Customer
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-6">
                                    <p class="TEXT-CONTENT text-slate-500 dark:text-white/90">
                                        I've never been happier with my skin. Thank you, Dream Skin Nepal!
                                    </p>
                                    <ul class="flex items-center gap-2 text-amber-400 text-xl">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="mx-auto px-4 py-10 max-w-7xl flex flex-col gap-16 shadow">
                <div>
                    <div class="mx-auto text-center max-w-3xl">
                        <h2 class="text-4xl font-semibold text-[#00adef]">Join Our
                            Skincare Community</h2>
                    </div>
                </div>
                <div class="mx-auto max-w-4xl">
                    <div class="grid grid-cols-1 gap-12 text-center md:grid-cols-3">
                        <div>
                            <p class="text-5xl font-semibold text-[#ff007f]">98%</p>
                            <h3 class="TITLE-SECONDARY mt-4 text-lg font-semibold text-slate-900 dark:text-white/90">
                                Customer Satisfaction</h3>
                            <p class="DESC mt-1 text-sm font-normal text-slate-600 dark:text-white/70">Our customers
                                love our products</p>
                        </div>
                        <div>
                            <p class="text-5xl font-semibold text-[#ff007f]">100%</p>
                            <h3 class="TITLE-SECONDARY mt-4 text-lg font-semibold text-slate-900 dark:text-white/90">
                                Quality Guarantee</h3>
                            <p class="DESC mt-1 text-sm font-normal text-slate-600 dark:text-white/70">We ensure
                                top-quality products</p>
                        </div>
                        <div>
                            <p class="text-5xl font-semibold text-[#ff007f]">24/7</p>
                            <h3 class="TITLE-SECONDARY mt-4 text-lg font-semibold text-slate-900 dark:text-white/90">
                                Customer Support</h3>
                            <p class="DESC mt-1 text-sm font-normal text-slate-600 dark:text-white/70">We're here to
                                help anytime</p>
                        </div>
                    </div>
                    <div>
                        <div class="mt-12 pt-10 text-center border-t border-black/10 dark:border-white/10">
                            <button
                                class="bg-[#00adef] hover:bg-[#ff007f] font-medium text-white border-0 py-3 px-6 focus:outline-none rounded-lg text-sm sm:text-base 2xl:text-lg transition-colors duration-500">
                                Contact Us Today
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <?php include('Assets/Components/Footer.php'); ?>
    </footer>
</body>

</html>