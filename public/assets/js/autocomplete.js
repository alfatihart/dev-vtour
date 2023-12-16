let availableKeywords = [
  'HTML',
  'CSS',
  'JavaScript',
  'PHP',
  'Python',
  'Ruby',
  'Java',
  'C',
  'C++',
  'C#',
  'Go',
  'Scala',
  'Swift',
  'Kotlin',
  'React',
  'Vue',
  'Angular',
  'Laravel',
  'Symfony',
  'Django',
  'Rails',
  'Spring',
  'Express',
  'Flask',
  'CodeIgniter',
  'CakePHP'];

const resultBox = document.querySelector('.result-box');
const inputBox = document.querySelector('.input-box');

inputBox.onkeyup = function() {
  let result = [];
  let input = inputBox.value;
  if(input.length) {
    result = availableKeywords.filter(keyword => {
      keyword.toLowerCase().includes(input.toLowerCase());
    });
    console.log(result);
  }
}