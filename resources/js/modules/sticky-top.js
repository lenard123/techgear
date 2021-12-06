export default function stickyTop(el){

  const { offsetTop } = el;
  document.addEventListener('scroll', () => {
    if (window.scrollY > offsetTop && el.style.position !== 'fixed') {
      el.style.position = 'fixed'
    } else if (window.scrollY <= offsetTop && el.style.position !== null){
      el.style.position = null
    }
  })

}