// auth.js

export function requireAuth(to, from, next) {
    const isAuthenticated = localStorage.getItem('token')
  
    if (isAuthenticated) {
      // User is authenticated, allow navigation
      next();
    } else {
      // User is not authenticated, redirect to login page
      next('/login');
    }
  }
  