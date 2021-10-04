export const autodefine = () => {
  const defined = {};

  const define = (node) => {
    if (node.getAttribute) {
      const attr = node.getAttribute("id");
      if (attr) {
        defined[attr] = node;
      }
      const children = [...node.childNodes];
      children.forEach((child) => {
        define(child);
      });
    }
  };

  define(document.body);

  return defined;
};

export const defineId = (args) => {
  const defined = [];
  args.forEach((id) => {
    const el = document.getElementById(id);
    defined.push(el);
  });
  return defined;
};
