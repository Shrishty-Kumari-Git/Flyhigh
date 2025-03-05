<style>
    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 50;
        transition: all 0.3s ease-in-out;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<!-- Header Section -->
<header class="sticky-header bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <div class='flex items-center'>
            <img src="<?php echo getSrcImg('logo.png'); ?>" alt="FlyHigh Logo" class="h-10">
            <div class="text-2xl font-bold ml-4 text-blue-600">FlyHigh</div>
        </div>

        <nav class="hidden md:flex space-x-6 text-lg font-medium">
            <a href="<?php echo base_url(); ?>" class="hover:text-blue-500 transition duration-300">Home</a>
            <a href="<?php echo base_url() . 'general/contactus'; ?>" class="hover:text-blue-500 transition duration-300">Contact</a>
            <a href="<?php echo base_url() . 'general/aboutus'; ?>" class="hover:text-blue-500 transition duration-300">About</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="menu-toggle" class="md:hidden text-gray-700 text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <nav id="mobile-menu" class="hidden md:hidden flex flex-col bg-white px-6 py-4 space-y-2 shadow-md">
        <a href="<?php echo base_url(); ?>" class="block text-lg font-medium hover:text-blue-500">Home</a>
        <a href="<?php echo base_url() . 'general/contactus'; ?>" class="block text-lg font-medium hover:text-blue-500">Contact</a>
        <a href="<?php echo base_url() . 'general/aboutus'; ?>" class="block text-lg font-medium hover:text-blue-500">About</a>
    </nav>
</header>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
