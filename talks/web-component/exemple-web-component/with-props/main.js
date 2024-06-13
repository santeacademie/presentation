document.addEventListener('DOMContentLoaded', () => {
  const users = [
    { name: 'John Doe', age: 30 },
    { name: 'Jane Smith', age: 25 },
    { name: 'Alice Johnson', age: 28 },
    { name: 'Bob Brown', age: 32 }
  ];

  const container = document.getElementById('user-cards-container');

  users.forEach(user => {
    const userCard = document.createElement('user-card');
    userCard.setAttribute('name', user.name);
    userCard.setAttribute('age', user.age);
    container.appendChild(userCard);
  });
});