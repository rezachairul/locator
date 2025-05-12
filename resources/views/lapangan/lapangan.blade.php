<x-operator.layouts
    :title="$title"
    :totalExca="$totalExca"
    :totalDumping="$totalDumping"
    :latestWeather="$latestWeather"
    :latestWaterDepth="$latestWaterDepth"
>
    <!-- Maps -->
    <div class="relative w-full h-full">
        <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow-xs" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8297.885022528028!2d117.42045017766056!3d2.02715899014462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x320def43f33ea91b%3A0x7e4dcd38dcbb294c!2sWorkshop%20MTL%20Binungan%20KM1!5e1!3m2!1sid!2sid!4v1721883321328!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</x-operator.layouts>
