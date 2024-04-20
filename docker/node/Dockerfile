ARG NODE_VERSION=18.16.0

FROM node:${NODE_VERSION} as node_base
WORKDIR /var/www
EXPOSE 5173

FROM node_base as node_deps

RUN apt-get update && apt-get install -y yarn
CMD yarn && yarn dev

FROM node_deps as node_build

CMD ["sh", "-c", "yarn build"]

FROM node_base as node_prod

ENV NODE_ENV production

USER node

COPY package.json .

#COPY --from=node_deps /var/www/node_modules ./node_modules
COPY --from=node_build /var/www/public ./public

#FROM node_deps as node_dev
#
#CMD yarn dev
