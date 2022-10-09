//Fade Scroll Books Animations
window.addEventListener('scroll', function fade_books()
{
	let i = 4;
	var img = document.querySelectorAll('.card')[5];

	while (img = document.querySelectorAll('.card')[i])
	{
		var altura = window.innerHeight;
		var distancia = img.getBoundingClientRect().top;

        console.log(altura);
        console.log(distancia);

		if (distancia < altura)
		img.classList.add('appear');
		else
		img.classList.remove('appear');
		i++;
	}
})
