    <!-- jQuery and Toastr JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}

    <!-- Toastr JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    {{-- slider --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".categorySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                },
                992: {
                    slidesPerView: 4
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    {!! ToastMagic::scripts() !!}
    <script>
        let index = 0;
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");
        const track = document.querySelector(".slider-track");

        function showSlide() {
            index++;
            if (index >= slides.length) index = 0;

            const slideWidth = slides[0].offsetWidth + 30; // width + margin
            track.style.transform = `translateX(-${index * slideWidth}px)`;

            dots.forEach(dot => dot.classList.remove("active"));
            dots[index].classList.add("active");

            setTimeout(showSlide, 4000);
        }

        showSlide();
    </script>
    <script>
        const footer = document.querySelector('.fixed-footer');

        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;

            // when user reaches bottom
            if (scrollTop + windowHeight >= documentHeight - 5) {
                footer.classList.add('show');
            } else {
                footer.classList.remove('show');
            }
        });
    </script>
    {{-- scrollbar --}}
    <script>
        const scrollTop = document.querySelector('.scrolltop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollTop.style.display = 'flex';
            } else {
                scrollTop.style.display = 'none';
            }
        });

        scrollTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    {{-- //toaster --}}
    {{-- <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            showDuration: 300,
            hideDuration: 1000,
            timeOut: 5000,
            extendedTimeOut: 1000,
            newestOnTop: true,
            preventDuplicates: true
        };

        @if (session()->has('message'))
            const type = "{{ session('alert-type', 'info') }}";
            const message = @json(session('message'));

            switch (type) {
                case 'success':
                    toastr.success(message);
                    break;
                case 'error':
                    toastr.error(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                default:
                    toastr.info(message);
            }
        @endif
    </script> --}}
    <!-- Include at the end of body -->
    
<script>
function refreshCartCount() {
    fetch('/cart-count')
        .then(res => res.json())
        .then(data => {
            document.querySelectorAll('#cartCount').forEach(el => {
                el.textContent = data.cartCount;
            });
        });
}

// Run on page load and on pageshow (back button)
window.addEventListener('DOMContentLoaded', refreshCartCount);
window.addEventListener('pageshow', refreshCartCount);

function cartUpdate(action, productId, inputEl = null) {
    let url = '';
    let data = {};

    if (action === 'increment' || action === 'decrement') {
        const qty = action === 'increment'
            ? parseInt(inputEl.value) + 1
            : Math.max(1, parseInt(inputEl.value) - 1);

        url = `/cart/update/${productId}`;
        data = { qty };
    } else if (action === 'remove') {
        url = `/cart/remove/${productId}`;
    }

    fetch(url, {
        method: action === 'remove' ? 'GET' : 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: action === 'remove' ? null : JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
        // Update order page table
        if (action === 'remove') {
            document.getElementById(`cartRow-${productId}`).remove();
        } else {
            inputEl.value = res.qty;
            document.getElementById(`total-${productId}`).textContent = res.total_price;
        }

        // Update cart count on all pages dynamically
        document.querySelectorAll('#cartCount').forEach(el => {
            el.textContent = res.cartCount;
        });

        // Optional: alert if cart empty
        if(res.cartCount === 0){
            // Do something, like hide order button
        }
    });
}
</script>
    @stack('js')
    </body>

    </html>
