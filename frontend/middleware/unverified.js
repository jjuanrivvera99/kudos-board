export default ({app, redirect}) => {
  if (app.$auth.loggedIn && app.$auth.user.email_verified_at) {
    return redirect('/');
  }
}
