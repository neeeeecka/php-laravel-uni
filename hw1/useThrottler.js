const useThrottler = () => {
  const throttler = {
    current: false,
    stack: [],
  };
  const withThrottler = (mayNotHappen) => {
    throttler.current = true;

    mayNotHappen();

    setTimeout(() => {
      throttler.current = false;
    }, 150);
  };
  return {
    withThrottler,
  };
};
export default useThrottler;
