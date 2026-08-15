document.addEventListener('DOMContentLoaded', () => {

    const cards = document.querySelectorAll('.counter-card');

    const counters = document.querySelectorAll('.counter');

    let started = false;

    const observer = new IntersectionObserver((entries)=>{

        entries.forEach(entry=>{

            if(!entry.isIntersecting || started){

                return;

            }

            started = true;

            cards.forEach((card,index)=>{

                setTimeout(()=>{

                    card.classList.add('show');

                },index*120);

            });

            counters.forEach(counter=>{

                const target = Number(counter.dataset.target);

                let current = 0;

                const increment = Math.max(1,Math.ceil(target/80));

                const suffix = counter.dataset.suffix || "+";

                const update = ()=>{

                    current += increment;

                    if(current>target){

                        current=target;

                    }

                    counter.textContent=current+suffix;

                    if(current<target){

                        requestAnimationFrame(update);

                    }

                };

                update();

            });

        });

    },{

        threshold:.35

    });

    observer.observe(document.querySelector(".counter-section"));

});