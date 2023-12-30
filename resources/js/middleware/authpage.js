// auth.js

export function Auth(to, from, next) {
    const isAuthenticated = localStorage.getItem('token')
  
    if (isAuthenticated) {
      // User is authenticated, allow navigation
      next('/profile');
    } else {
      // User is not authenticated, redirect to login page
      next();
    }
  }
  